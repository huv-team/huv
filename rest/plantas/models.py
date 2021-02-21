from django.db import models

MESES = [('1', 'Enero'), ('2', 'Febrero'), ('3', 'Marzo'),
         ('4', 'Abril'), ('5', 'Mayo'), ('6', 'Junio'),
         ('7', 'Julio'), ('8', 'Agosto'), ('9', 'Septiembre'),
         ('10', 'Octubre'), ('11', 'Noviembre'), ('12', 'Diciembre')]

REFS = [('LI', 'Libro'), ('RE', 'Revista'), ('PE', 'Periódico'),
        ('PW', 'Pagina web'), ('DI', 'Diccionario'), ('RS', 'Red social'),
        ('WP', 'Wikipedia'), ('PP', 'Power point')]

TIPOS_EP = [('AL', 'Almácigo'), ('SI', 'Siembra'),
            ('TR', 'Trasplante'), ('CO', 'Cosecha')]


class IntegerRangeField(models.IntegerField):
    def __init__(self, verbose_name=None, name=None, min_value=None,
                 max_value=None, **kwargs):
        self.min_value, self.max_value = min_value, max_value
        models.IntegerField.__init__(self, verbose_name, name, **kwargs)

    def formfield(self, **kwargs):
        defaults = {'min_value': self.min_value, 'max_value': self.max_value}
        defaults.update(kwargs)
        return super(IntegerRangeField, self).formfield(**defaults)


def get_name(self,):
    return self.nombre_popular if self.nombre_popular\
                               else self.nombre_cientifico


def get_fecha(dia=None, mes=None):
    if dia is 0:
        fecha = '{}'.format(MESES[int(mes)-1][1])
    else:
        fecha = '{}/{}'.format(dia, mes)
    return fecha


class Familia(models.Model):
    nombre_cientifico = models.CharField(max_length=200, null=True, blank=True)
    nombre_popular = models.CharField(max_length=200, null=True, blank=True)

    def __str__(self,):
        return get_name(self)


class Tipo(models.Model):
    nombre = models.CharField(max_length=200, null=True, blank=True, choices=[
        ('FR', 'Fruto'),
        ('FL', 'Flor'),
        ('HO', 'Hoja'),
        ('RA', 'Raiz'),
    ])

    def __str__(self,):
        return self.get_nombre_display()


class Planta(models.Model):
    nombre_popular = models.CharField(max_length=200)
    nombre_cientifico = models.CharField(max_length=200, null=True, blank=True)
    variedad = models.CharField(max_length=200, null=True, blank=True)
    familia = models.ForeignKey(Familia, on_delete=models.SET_NULL, null=True,
                                blank=True, related_name='plantas')
    tipo = models.ForeignKey(Tipo, on_delete=models.SET_NULL, null=True,
                             related_name='fichas')

    def previous(self):
        try:
            return (Planta.objects
                    .filter(nombre_popular__lt=self.nombre_popular)
                    .last())
        except IndexError:
            return None

    def next(self):
        try:
            return (Planta.objects
                    .filter(nombre_popular__gt=self.nombre_popular)
                    .first())
        except IndexError:
            return None

    class Meta:
        ordering = ('nombre_popular', 'variedad')

    def __str__(self,):
        return get_name(self)

    #__str__.admin_order_field = '__str__'


class Rotacion(models.Model):
    anterior = models.ForeignKey(Familia, on_delete=models.SET_NULL, null=True,
                                 related_name='anterior')
    actual = models.ForeignKey(Familia, on_delete=models.SET_NULL, null=True,
                               related_name='actual')
    posterior = models.ForeignKey(Familia, on_delete=models.SET_NULL,
                                  null=True, related_name='posterior')

    class Meta:
        verbose_name = "Rotación"
        verbose_name_plural = "Rotaciones"

    def __str__(self,):
        return get_name(self.actual)


class Epoca(models.Model):
    tipo = models.CharField(max_length=20, default=TIPOS_EP[0],
                            choices=TIPOS_EP)
    desde_dia = IntegerRangeField(default=0,
                                  min_value=0, max_value=31)
    desde_mes = models.CharField(max_length=20, default=MESES[0][0],
                                 choices=MESES)
    hasta_dia = IntegerRangeField(default=0,
                                  min_value=0, max_value=31)
    hasta_mes = models.CharField(max_length=20, default=MESES[-1][0],
                                 choices=MESES)
    # id_str = models.CharField(max_length=30)

    #@property
    def get_titulo(self,):
        tipo = self.get_tipo_display()
        desde = get_fecha(self.desde_dia, self.desde_mes)
        hasta = get_fecha(self.hasta_dia, self.hasta_mes)
        if desde != hasta:
            titulo = '{}: {} - {}'.format(tipo, desde, hasta)
        else:
            titulo = '{}: {}'.format(tipo, desde)
        return titulo
    get_titulo.short_description = "Titulo del registro Epoca"
    get_titulo.admin_order_field = 'tipo'
    titulo = property(get_titulo)

    class Meta:
        app_label = 'plantas'
        ordering = ["tipo"]
        constraints = [
            models.UniqueConstraint(fields=['tipo', 'desde_dia', 'desde_mes',
                                            'hasta_dia', 'hasta_mes'],
                                    name='unique days and months'),
                      ]

    def __str__(self,):
        return self.titulo


class Autor(models.Model):
    primer_nombre = models.CharField(max_length=200, null=True)
    segundo_nombre = models.CharField(max_length=200, null=True, blank=True)
    apellido = models.CharField(max_length=200, null=True)

    def get_nombre(self, ):
        nombre = ''
        if self.segundo_nombre:
            nombre = '{}, {} {}.'.format(self.apellido, self.primer_nombre,
                                         self.segundo_nombre[0])
        else:
            nombre = '{}, {}'.format(self.apellido, self.primer_nombre)

        return nombre

    class Meta:
        verbose_name = "Autor"
        verbose_name_plural = "Autores"

    def __str__(self, ):
        return self.get_nombre()


class AutorOrden(models.Model):
    autor = models.ForeignKey(Autor, on_delete=models.CASCADE)
    fuente = models.ForeignKey('Fuente', on_delete=models.CASCADE, related_name='autores_ordenados')
    orden = models.IntegerField(default=1)

    class Meta:
        verbose_name = "Autor orden"
        verbose_name_plural = "Autor ordenes"
        ordering = ('orden', )


class Fuente(models.Model):
    tipo = models.CharField(max_length=20, default=None, null=True, 
                            blank=True, choices=REFS)
    autores = models.ManyToManyField(Autor, blank=True, through=AutorOrden,
                                     through_fields=('fuente', 'autor'))
    anio = models.TextField(null=True, blank=True)
    titulo = models.TextField(null=True, blank=True)
    capitulo = models.TextField(null=True, blank=True)
    editorial = models.TextField(null=True, blank=True)
    edicion = models.IntegerField(null=True, blank=True)
    volumen = models.IntegerField(null=True, blank=True)
    pag_inicio = models.IntegerField(null=True, blank=True)
    pag_fin = models.IntegerField(null=True, blank=True)
    url = models.URLField(null=True, blank=True)
    numero = models.IntegerField(null=True, blank=True)
    nombre_pag = models.TextField(max_length=200, null=True, blank=True)
    nombre_revista = models.TextField(null=True, blank=True)
    acceso = models.DateField(null=True, blank=True)
    contenido = models.TextField(null=True, blank=True)
    tipo_cont = models.TextField(null=True, blank=True)  # Foto, video, etc
    usuario = models.TextField(null=True, blank=True)
    red_social = models.CharField(max_length=10, null=True, blank=True,
                                  choices=[('YT', 'Youtube'),
                                           ('TW', 'Twitter'),
                                           ('IN', 'Instagram'),
                                           ('FB', 'Facebook')])
    otros = models.TextField(null=True, blank=True)

    def get_tipo(self, ):
        return self.get_tipo_display()

    def __str__(self,):
        return self.autores.filter(autororden__orden=1)[0].get_nombre()\
            if self.autores.all() else 'None'


class Tip(models.Model):
    titulo = models.CharField(max_length=200, null=True, blank=True)
    contenido = models.TextField(null=True, blank=True)
    fuente = models.ForeignKey(Fuente, on_delete=models.SET_NULL, null=True,
                               related_name='citada_en_tips')

    def __str__(self,):
        return self.titulo if self.titulo else 'None'


class Sustrato(models.Model):
    tierra = models.CharField(max_length=200, null=True, blank=True)
    potasio = models.BooleanField(default=False)
    nitrogeno = models.BooleanField(default=False)
    fosforo = models.BooleanField(default=False)

    def __str__(self,):
        return self.tierra


class Ficha(models.Model):
    planta = models.OneToOneField(Planta, on_delete=models.SET_NULL, null=True,
                                  related_name='ficha')
    # Dimesión
    tamano = models.CharField(max_length=200, null=True, blank=True,
                              choices=[('S', 'Chico'),
                                       ('M', 'Mediano'),
                                       ('L', 'Grande'),
                                       ('XL', 'Extra Grande')])
    volumen_maceta_ltr = IntegerRangeField(null=True, blank=True, min_value=1)
    profundidad_cm = IntegerRangeField(null=True, blank=True, min_value=1)
    distancia_min_cm = IntegerRangeField(null=True, blank=True, min_value=1)
    distancia_max_cm = IntegerRangeField(null=True, blank=True, min_value=1)
    # Cuidados
    horas_sol_min = IntegerRangeField(null=True, blank=True, min_value=1)
    horas_sol_max = IntegerRangeField(null=True, blank=True, min_value=1)
    temperatura_min = IntegerRangeField(null=True, blank=True, min_value=1)
    temperatura_max = IntegerRangeField(null=True, blank=True, min_value=1)
    riego = models.CharField(max_length=200, null=True, blank=True, choices=[
        ('c15D', 'Cada 15 días'),
        ('1xS', 'Una vez por semana'),
        ('2xS', 'Dos veces por semana'),
        ('c2D', 'Cada dos días'),
        ('1xD', 'Una vez por día'),
        ('2xD', 'Dos veces por día'),])
    tolera_sombra = models.BooleanField(default=False)
    tutorado = models.BooleanField(default=False)
    aporque = models.BooleanField(default=False)
    # Cultivo
    tiempo_cultivo_min_dias = IntegerRangeField(null=True, blank=True,
                                                min_value=1)
    tiempo_cultivo_max_dias = IntegerRangeField(null=True, blank=True,
                                                min_value=1)
    epocas = models.ManyToManyField(Epoca, blank=True, related_name='fichas')
    sustrato = models.ManyToManyField(Sustrato, blank=True,
                                      related_name='Sutrato')
    fecundacion = models.CharField(max_length=20, null=True, blank=True, 
                                   choices=[('AU', 'Autofecundación'),
                                            ('CR', 'cruzada')])
    tips = models.ManyToManyField(Tip, blank=True)
    # Referencia
    fuentes = models.ManyToManyField(Fuente, blank=True)

    def __str__(self,):
        return get_name(self.planta)


class Interaccion(models.Model):
    target = models.ForeignKey(Planta, on_delete=models.SET_NULL, null=True,
                               related_name='interaciones')
    tipo = models.CharField(max_length=10, default='B', choices=[
         ('B', 'Benéfica'),
         ('P', 'Perjudicial'),
     ])
    actor = models.ManyToManyField(Planta)
    relacion = models.TextField(max_length=15, null=True, blank=True)

    class Meta:
        verbose_name = "Interacción"
        verbose_name_plural = "Interacciones"

    def __str__(self,):
        return get_name(self.target)

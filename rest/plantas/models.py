from django.db import models


MESES = [('ENE', 'Enero'), ('FEB', 'Febrero'), ('MAR', 'Marzo'),
         ('ABR', 'Abril'), ('MAY', 'Mayo'), ('JUN', 'Junio'),
         ('JUL', 'Julio'), ('AGO', 'Agosto'), ('SEP', 'Septiembre'),
         ('OCT', 'Octubre'), ('NOV', 'Noviembre'), ('DIC', 'Diciembre')]

REFS = [('LI', 'Libro'), ('RE', 'Revista'), ('PE', 'Periódico'),
        ('PW', 'Pagina web'), ('DI', 'Diccionario'), ('RS', 'Red social'),
        ('WP', 'Wikipedia'), ('PP', 'Power point')]


def get_name(self,):
    return self.nombre_popular if self.nombre_popular\
                               else self.nombre_cientifico

def get_fecha(self,):
    return '{}/{}'.format(self.desde_, self.hasta)

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
    nombre_popular = models.CharField(max_length=200, null=True, blank=True)
    nombre_cientifico = models.CharField(max_length=200, null=True, blank=True)
    variedad = models.CharField(max_length=200, null=True, blank=True)
    familia = models.ForeignKey(Familia, on_delete=models.SET_NULL, null=True,
                                blank=True, related_name='plantas')
    tipo = models.ForeignKey(Tipo, on_delete=models.SET_NULL, null=True,
                             related_name='fichas')

    def __str__(self,):
        return get_name(self)

    __str__.admin_order_field = '__str__'


class Rotacion(models.Model):
    anterior = models.ForeignKey(Familia, on_delete=models.SET_NULL, null=True,
                                 related_name='anterior')
    actual = models.ForeignKey(Familia, on_delete=models.SET_NULL, null=True,
                               related_name='actual')
    posterior = models.ForeignKey(Familia, on_delete=models.SET_NULL,
                                  null=True, related_name='posterior')

    def __str__(self,):
        return get_name(self.actual)


class Epoca(models.Model):
    tipo = models.CharField(max_length=200, null=True, blank=True,
                            choices=[('SE', 'Semillero'), ('SI', 'Siembra'),
                                     ('TR', 'Trasplante'), ('CO', 'Cosecha')])
    desde_dia = models.IntegerField(null=True, blank=True)
    desde_mes = models.CharField(max_length=200, null=True, blank=True,
                                 default='ENE', choices=MESES)
    hasta_dia = models.IntegerField(null=True, blank=True)
    hasta_mes = models.CharField(max_length=200, null=True, blank=True,
                                 default='DIC', choices=MESES)

    def __str__(self,):
        return '{} del {} a {}'.format(self.get_tipo_display(),
                                      self.desde_mes, self.hasta_mes)


class Autor(models.Model):
    primer_nombre = models.CharField(max_length=20, null=True)
    segundo_nombre = models.CharField(max_length=20, null=True, blank=True)
    apellido = models.CharField(max_length=20, null=True)

    def __str__(self,):
        return self.apellido if self.apellido else 'None'


class AutorOrden(models.Model):
    autor = models.ForeignKey(Autor, on_delete=models.CASCADE)
    fuente = models.ForeignKey('Fuente', on_delete=models.CASCADE)
    orden = models.IntegerField(default=1)

    class Meta:
        ordering = ('orden', )


class Fuente(models.Model):
    tipo = models.CharField(default='LI', max_length=20, choices=REFS)
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
    nombre_pag = models.TextField(null=True, blank=True)
    articulo = models.TextField(null=True, blank=True)
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

    #def get_fields(self, request, obj=None):
    #    if getattr(obj, 'tipo') == 'LI':
    #        out = ('tipo', 'autores', 'anio', 'titulo', 'editorial', 'edicion',
    #               'volumen', 'pag_inicio', 'pag_final', 'url')
    #    elif obj == 'RE':
    #        out = ('tipo', 'autores', 'anio', 'articulo', 'titulo', 'volumen',
    #               'numero', 'pag_inicio', 'pag_final', 'url')
    #    elif obj == 'PW':
    #        out = ('tipo', 'autores', 'acceso', 'titulo', 'nombre_pag', 'url')
    #    elif obj == 'RS':
    #        out = ('tipo', 'autores', 'usuario', 'acceso', 'contenido', 'url')
    #    else:
    #        out = ()
    #    return out

    def __str__(self,):
        return self.autores.filter(autororden__orden=1)[0].apellido\
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
                                  related_name='fichas')
    tamano = models.CharField(max_length=200, null=True, blank=True,
                              choices=[('S', 'Chico'),
                                       ('M', 'Mediano'),
                                       ('L', 'Grande'),
                                       ('XL', 'Extra Grande')])
    volumen_maceta_ltr = models.DecimalField(null=True, max_digits=5,
                                             blank=True, decimal_places=0)
    profundidad_cm = models.DecimalField(null=True, blank=True, max_digits=5,
                                         decimal_places=0)
    distancia_cm = models.DecimalField(null=True, blank=True, max_digits=5,
                                       decimal_places=0)
    temperatura_min = models.DecimalField(null=True, blank=True, max_digits=5,
                                          decimal_places=0)
    temperatura_max = models.DecimalField(null=True, blank=True, max_digits=5,
                                          decimal_places=0)
    horas_sol_min = models.DecimalField(null=True, blank=True, max_digits=5,
                                        decimal_places=0)
    horas_sol_max = models.DecimalField(null=True, blank=True, max_digits=5,
                                        decimal_places=0)
    soporta_sombra = models.BooleanField(default=False)
    tutorado = models.BooleanField(default=False)
    riego = models.CharField(max_length=200, null=True, blank=True, choices=[
        ('c15D', 'Cada 15 días'),
        ('1xS', 'Una vez por semana'),
        ('2xS', 'Dos veces por semana'),
        ('c2D', 'Cada dos días'),
        ('1xD', 'Una vez por día'),
        ('2xD', 'Dos veces por día'),
    ])
    tiempo_cultivo_semanas = models.IntegerField(null=True, blank=True)
    epocas = models.ManyToManyField(Epoca, null=True, blank=True,
                                    related_name='epocas')
    sustrato = models.ManyToManyField(Sustrato, blank=True,
                                      related_name='Sutrato')
    tips = models.ManyToManyField(Tip, blank=True)
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

    def __str__(self,):
        return get_name(self.target)

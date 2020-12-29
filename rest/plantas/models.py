from django.db import models


MESES = [('ENE', 'Enero'), ('FEB', 'Febrero'), ('MAR', 'Marzo'),
         ('ABR', 'Abril'), ('MAY', 'Mayo'), ('JUN', 'Junio'),
         ('JUL', 'Julio'), ('AGO', 'Agosto'), ('SEP', 'Septiembre'),
         ('OCT', 'Octubre'), ('NOV', 'Noviembre'), ('DIC', 'Diciembre')]


def get_name(self,):
    return self.nombre_popular if self.nombre_popular\
                               else self.nombre_cientifico


class Familia(models.Model):
    nombre_cientifico = models.CharField(max_length=200, null=True, blank=True)
    nombre_popular = models.CharField(max_length=200, null=True, blank=True)

    def __str__(self,):
        return get_name(self)


class Tipo(models.Model):
    nombre = models.CharField(max_length=200, null=True, blank=True, choices=[
        ('FR', 'Fruta'),
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
    desde = models.CharField(max_length=200, null=True, blank=True,
                             default='ENE', choices=MESES)
    hasta = models.CharField(max_length=200, null=True, blank=True,
                             default='DIC', choices=MESES)

    def __str__(self,):
        return '{} de {} a {}'.format(self.get_tipo_display(),
                                      self.desde, self.hasta)


class Autor(models.Model):
    autor = models.CharField(max_length=200, null=True)

    def __str__(self,):
        return self.autor if self.autor else 'None'


class Fuente(models.Model):
    primer_autor = models.ForeignKey(Autor, on_delete=models.SET_NULL,
                                     null=True, related_name='primer_autor')
    otros_autores = models.ManyToManyField(Autor, blank=True)
    cita = models.TextField(null=False, blank=True)
    url = models.TextField(null=True, blank=True)

    def __str__(self,):
        return self.primer_autor.autor if self.primer_autor else 'None'


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
    planta = models.ForeignKey(Planta, on_delete=models.SET_NULL, null=True,
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
    sombra = models.BooleanField(default=False)
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
    epoca_semillero = models.ForeignKey(Epoca, on_delete=models.SET_NULL,
                                        null=True, blank=True,
                                        related_name='fichas_semillero')
    epoca_siembra = models.ForeignKey(Epoca, on_delete=models.SET_NULL,
                                      null=True, blank=True,
                                      related_name='fichas_siembra')
    epoca_trasplante = models.ForeignKey(Epoca, on_delete=models.SET_NULL,
                                         null=True, blank=True,
                                         related_name='fichas_trasplante')
    epoca_cosecha = models.ForeignKey(Epoca, on_delete=models.SET_NULL,
                                      null=True, blank=True,
                                      related_name='fichas_cosecha')
    sustrato = models.ManyToManyField(Sustrato, blank=True,
                                      related_name='Sutrato')
    tips = models.ManyToManyField(Tip, blank=True)
    fuentes = models.ManyToManyField(Fuente, blank=True)

    def __str__(self,):
        return get_name(self.planta)


class Interaccion(models.Model):
    target = models.ForeignKey(Planta, on_delete=models.SET_NULL, null=True,
                               related_name='interaciones')
    # tipo = models.CharField(max_length=200, null=False, choices=[
    #     ('B', 'Benéfica'),
    #     ('P', 'Perjudicial'),
    # ])
    # actores = models.ManyToManyField(Planta, blank=True)
    benefica = models.ManyToManyField(Planta, blank=True,
                                      related_name='Benéfica')
    perjudicial = models.ManyToManyField(Planta, blank=True,
                                         related_name='Perjudicial')

    def __str__(self,):
        return get_name(self.target)

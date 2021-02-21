from django import forms
from django.contrib import admin
from nested_admin import (NestedModelAdmin, NestedStackedInline,
                          NestedTabularInline)
from plantas import models
from django.db.models import Q
import re, unicodedata, itertools

FUENTE = ('__str__', 'tipo', 'titulo', 'anio', 'acceso', 'url')

def normalize(text):
    text = unicodedata.normalize('NFD', text)\
        .encode('ascii', 'ignore').decode("utf-8").lower()
    return text

# INLINES #####################################################################


class InteraccionInline(NestedTabularInline):
    model = models.Interaccion
    extra = 0
    can_delete = True
    search_fields = ['actor', 'actor__tipo__nombre',
                     'actor__familia__nombre_popular']
    filter_horizontal = ('actor', )
    classes = ('grp-collapse grp-closed',)


class PlantaInline(NestedTabularInline):
    model = models.Planta
    extra = 0
    can_delete = False


class FuenteInline(NestedTabularInline):
    model = models.Ficha.fuentes.through
    extra = 0
    can_delete = False
    classes = ('grp-collapse grp-closed',)


class EpocaInline(NestedTabularInline):
    model = models.Ficha.epocas.through
    extra = 0
    can_delete = False
    classes = ('grp-collapse grp-closed',)


class TipInline(NestedTabularInline):
    model = models.Ficha.tips.through
    extra = 0
    can_delete = False
    classes = ('grp-collapse grp-closed',)


class FichaInline(NestedStackedInline):
    model = models.Ficha
    extra = 1
    fieldsets = [
           ('Dimensión', {'fields': [('tamano', 'volumen_maceta_ltr'),
                          ('profundidad_cm', 'distancia_min_cm',
                           'distancia_max_cm')]}),
           ('Cuidados', {'fields': [('horas_sol_min', 'horas_sol_max',
                                     'tolera_sombra'),
                                    ('temperatura_min', 'temperatura_max',
                                     'tutorado', 'aporque'),
                                    ('riego', 'sustrato')]}),
           ('Cultivo', {'fields': [('epocas', 'tiempo_cultivo_min_dias',
                                    'tiempo_cultivo_max_dias'),
                                   ('fecundacion', 'tips')]}),
           ('Referencias', {'fields': [('fuentes', )]})]
    can_delete = False
    autocomplete_fields = ['epocas', 'sustrato', 'tips', 'fuentes']
    show_change_link = True
    inlines = [EpocaInline, TipInline, FuenteInline]
    classes = ('grp-collapse grp-open',)
    inline_classes = ('grp-collapse grp-open',)


class AutorInline(NestedTabularInline):
    model = models.Fuente.autores.through
    extra = 3
    can_delete = True

# ADMINS ######################################################################


class PlantaAdmin(NestedModelAdmin):
    fields = (('nombre_popular', 'nombre_cientifico'),
              ('variedad', 'familia', 'tipo'))
    list_display = ('__str__', 'familia', 'tipo', 'variedad',
                    'nombre_popular', 'nombre_cientifico')
    list_editable = ('nombre_popular', 'nombre_cientifico',
                     'variedad', 'familia', 'tipo')
    list_filter = ['tipo', 'familia']
    search_fields = ['nombre_popular', 'nombre_cientifico']
    ordering = ['nombre_popular', 'variedad']
    inlines = [FichaInline, InteraccionInline]

    # def sortable_str(self, obj):
    #     return obj.__str__()
    #
    # sortable_str.short_description = 'Planta'
    # sortable_str.admin_order_field = '__str__'


class FamiliaAdmin(NestedModelAdmin):
    pass


class RotacionAdmin(NestedModelAdmin):
    pass


class EpocaAdmin(NestedModelAdmin):
    search_fields = ['tipo', 'desde_dia', 'desde_mes', 'hasta_dia',
                     'hasta_mes']

    def get_search_results(self, request, queryset, search_term):

        meses = dict(models.MESES)
        tipos = dict(models.TIPOS_EP)
        search_term = normalize(search_term)
        terms = [s for s in re.split(r"[\s:-]+", search_term) if s]
        mes_keys = list()
        tipo_keys = list()
        for term in terms:
            mes_keys.extend([k for (k, v) in meses.items()
                            if normalize(v).startswith(term)])
            tipo_keys.extend([k for (k, v) in tipos.items()
                             if normalize(v).startswith(term)])

        query = Q()
        if tipo_keys: query &= Q(tipo__in=tipo_keys)
        if len(mes_keys) == 1: query &= Q(Q(desde_mes__in=mes_keys) | Q(hasta_mes__in=mes_keys))
        if len(mes_keys) > 1: query &= Q(Q(desde_mes__in=mes_keys) & Q(hasta_mes__in=mes_keys))
        return self.model.objects.filter(query), False


class AutorOrdenAdmin(NestedModelAdmin):
    pass


class AutorAdmin(NestedModelAdmin):
    search_fields = ['autor']


class FuenteAdmin(NestedModelAdmin):
    search_fields = ['autores__primer_nombre', 'autores__segundo_nombre',
                     'autores__apellido']
    list_display = FUENTE

    def get_fields(self, request, obj=None):

        field_name = 'tipo'
        if obj is not None:
            field_value = getattr(obj, field_name)
        else:
            field_value = None

        if field_value == 'LI':
            out = ('tipo', 'anio', 'titulo', 'editorial', 'edicion',
                   'volumen', 'pag_inicio', 'pag_fin', 'url', 'otros')
        elif field_value == 'RE':
            out = ('tipo', 'anio', 'titulo', 'nombre_revista', 'volumen',
                   'numero', 'pag_inicio', 'pag_fin', 'url', 'otros')
        elif field_value == 'PW':
            out = ('tipo', 'acceso', 'titulo', 'nombre_pag', 'url', 'otros')
        elif field_value == 'RS':
            out = ('tipo', 'usuario', 'acceso', 'contenido', 'url', 'otros')
        else:
            out = ('tipo', )
        return out

    inlines = [AutorInline, ]


class TipAdmin(NestedModelAdmin):
    search_fields = ['titulo']
    list_display = ('__str__', 'contenido', 'fuente')


class SustratoAdmin(NestedModelAdmin):
    search_fields = ['tierra']


class TipoAdmin(NestedModelAdmin):
    pass


class FichaAdmin(NestedModelAdmin):
    fieldsets = [
        (None, {'fields': [('planta', )]}),
        ('Dimensión', {'fields': [('tamano', 'volumen_maceta_ltr'),
                       ('profundidad_cm', 'distancia_min_cm',
                        'distancia_max_cm')]}),
        ('Cuidados', {'fields': [('horas_sol_min', 'horas_sol_max',
                                  'tolera_sombra'),
                                 ('temperatura_min', 'temperatura_max',
                                  'tutorado', 'aporque'),
                                 ('riego', 'sustrato')]}),
        ('Cultivo', {'fields': [('epocas', 'tiempo_cultivo_min_dias',
                                 'tiempo_cultivo_max_dias'),
                                ('fecundacion', 'tips')]}),
        ('Referencias', {'fields': [('fuentes', )]})]
    list_display = ('__str__', 'tamano', )
    search_fields = ['planta__nombre_popular', 'planta__nombre_cientifico',
                     'planta__variedad']
    autocomplete_fields = ['epocas', 'sustrato', 'tips', 'fuentes']
    inlines = [EpocaInline, TipInline, FuenteInline]


class InteraccionAdmin(NestedModelAdmin):
    filter_horizontal = ('actor',)


admin.site.register(models.Planta, PlantaAdmin)
admin.site.register(models.Familia, FamiliaAdmin)
admin.site.register(models.Rotacion, RotacionAdmin)
admin.site.register(models.Epoca, EpocaAdmin)
admin.site.register(models.AutorOrden, AutorOrdenAdmin)
admin.site.register(models.Autor, AutorAdmin)
admin.site.register(models.Fuente, FuenteAdmin)
admin.site.register(models.Tip, TipAdmin)
admin.site.register(models.Sustrato, SustratoAdmin)
admin.site.register(models.Tipo, TipoAdmin)
admin.site.register(models.Ficha, FichaAdmin)
admin.site.register(models.Interaccion, InteraccionAdmin)

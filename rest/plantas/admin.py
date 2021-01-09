from django.contrib import admin
from plantas import models

FSFICHA = [(None, {'fields': [('planta')]}),
           ('Dimensión', {'fields': [('tamano', 'volumen_maceta_ltr'),
                          ('profundidad_cm', 'distancia_cm')]}),
           ('Cuidados', {'fields': [('horas_sol_min', 'horas_sol_max',
                                     'soporta_sombra'),
                                    ('temperatura_min', 'temperatura_max',
                                     'tutorado'), ('riego', 'sustrato')]}),
           ('Cultivo', {'fields': [('epoca_semillero', 'epoca_siembra'),
                                   ('epoca_trasplante', 'epoca_cosecha'),
                        'tiempo_cultivo_semanas']}),
           (None, {'fields': [('tips', 'fuentes')]})]


class InteraccionInline(admin.TabularInline):
    model = models.Interaccion
    extra = 0
    can_delete = True
    autocomplete_fields = ['actor']


class FichaInline(admin.StackedInline):
    model = models.Ficha
    extra = 0
    fieldsets = FSFICHA
    can_delete = False
    autocomplete_fields = ['sustrato', 'tips', 'fuentes']


class PlantaInline(admin.TabularInline):
    model = models.Planta
    extra = 0
    can_delete = False


class AutorInline(admin.TabularInline):
    model = models.Fuente.autores.through
    extra = 3
    can_delete = True


class PlantaAdmin(admin.ModelAdmin):
    fields = (('nombre_popular', 'nombre_cientifico'),
              ('variedad', 'familia', 'tipo'))
    list_display = ('__str__', 'familia', 'tipo', 'variedad',
                    'nombre_popular', 'nombre_cientifico')
    list_editable = ('nombre_popular', 'nombre_cientifico',
                     'variedad', 'familia', 'tipo')
    list_filter = ['tipo', 'familia']
    search_fields = ['nombre_popular', 'nombre_cientifico']
    ordering = ['nombre_popular', 'variedad']
    inlines = [InteraccionInline, FichaInline]

    # def sortable_str(self, obj):
    #     return obj.__str__()
    #
    # sortable_str.short_description = 'Planta'
    # sortable_str.admin_order_field = '__str__'


class SustratoAdmin(admin.ModelAdmin):
    search_fields = ['tierra']


class AutorAdmin(admin.ModelAdmin):
    search_fields = ['autor']


class TipAdmin(admin.ModelAdmin):
    search_fields = ['titulo']


class FuenteAdmin(admin.ModelAdmin):
    search_fields = ['autores']
    list_display = ('__str__', 'tipo', 'titulo', 'url')
    autocomplete_fields = ['autores']

    def get_fields(self, request, obj=None):

        if models.Fuente._meta.fields[1].name == 'Libro':
            out = ('tipo', 'autores', 'anio', 'titulo', 'editorial', 'edicion',
                   'volumen', 'pag_inicio', 'pag_final', 'url')
        elif obj == 'RE':
            out = ('tipo', 'autores', 'anio', 'articulo', 'titulo', 'volumen',
                   'numero', 'pag_inicio', 'pag_final', 'url')
        elif obj == 'PW':
            out = ('tipo', 'autores', 'acceso', 'titulo', 'nombre_pag', 'url')
        elif obj == 'RS':
            out = ('tipo', 'autores', 'usuario', 'acceso', 'contenido', 'url')
        else:
            out = (models.Fuente._meta.fields[1].name, )
        return out
    inlines = (AutorInline,)


class FichaAdmin(admin.ModelAdmin):
    fieldsets = FSFICHA
    list_display = ('__str__', 'tamano')
    autocomplete_fields = ['sustrato', 'tips', 'fuentes']


class InteraccionAdmin(admin.ModelAdmin):
    autocomplete_fields = ['target', 'actor']


admin.site.register(models.Planta, PlantaAdmin)
admin.site.register(models.Familia)
admin.site.register(models.Rotacion)
admin.site.register(models.Epoca)
admin.site.register(models.AutorOrden)
admin.site.register(models.Autor, AutorAdmin)
admin.site.register(models.Fuente, FuenteAdmin)
admin.site.register(models.Tip, TipAdmin)
admin.site.register(models.Sustrato, SustratoAdmin)
admin.site.register(models.Tipo)
admin.site.register(models.Ficha, FichaAdmin)
admin.site.register(models.Interaccion, InteraccionAdmin)

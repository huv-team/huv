from rest_framework import viewsets
from rest_framework.response import Response

from django.db.models import Q

from plantas import models, serializer


class PlantaViewSet(viewsets.ModelViewSet):
    serializer_class = serializer.PlantaSerializer

    def get_queryset(self,):
        query = Q()
        nombre = self.request.query_params.get('nombre', None)
        if nombre is not None:
            query &= Q(Q(nombre_cientifico__icontains=nombre) |
                       Q(nombre_popular__icontains=nombre))
        queryset = models.Planta.objects.filter(query)
        return queryset


class FichaViewSet(viewsets.ModelViewSet):
    serializer_class = serializer.FichaSerializer
    queryset = models.Ficha.objects.all()

class FuenteViewSet(viewsets.ModelViewSet):
    serializer_class = serializer.FuenteSerializer
    queryset = models.Fuente.objects.all()

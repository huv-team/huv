import pandas as pd

from rest_framework import viewsets,views
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

class TipoViewSet(viewsets.ModelViewSet):
    serializer_class = serializer.TipoSerializer
    queryset = models.Tipo.objects.all()

class ListMeses(views.APIView):
    def get(self, request):
        return Response([{'id':M[0],'nombre':M[-1]} for M in models.MESES])

class ListMacetas(views.APIView):
    def get(self, request):
        macetas_data = pd.DataFrame(models.Ficha.objects.all().values('volumen_maceta_ltr','profundidad_cm'))
        return Response({
            'volumenes': macetas_data.volumen_maceta_ltr.dropna().unique().tolist(),
            'profundidades': macetas_data.profundidad_cm.dropna().unique().tolist(),
        })
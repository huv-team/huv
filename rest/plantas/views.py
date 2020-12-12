from rest_framework import viewsets
from rest_framework.response import Response

from plantas import models,serializer

class PlantaViewSet(viewsets.ModelViewSet):
    queryset = models.Planta.objects.all()
    serializer_class = serializer.PlantaSerializer


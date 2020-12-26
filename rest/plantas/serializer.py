from rest_framework import serializers

from plantas import models

class FamiliaSerializer(serializers.ModelSerializer):
    class Meta:
        model = models.Familia
        fields = '__all__'

class TipoSerializer(serializers.ModelSerializer):
    nombre = serializers.CharField(source='get_nombre_display')
    class Meta:
        model = models.Tipo
        fields = '__all__'

class PlantaSerializer(serializers.ModelSerializer):
    familia = FamiliaSerializer()
    tipo = TipoSerializer()
    class Meta:
        model = models.Planta
        fields = '__all__'
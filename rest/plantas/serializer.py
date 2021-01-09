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
    ficha = serializers.PrimaryKeyRelatedField(read_only=True)

    class Meta:
        model = models.Planta
        fields = '__all__'

class EpocaSerializer(serializers.ModelSerializer):
    tipo = serializers.CharField(source='get_tipo_display')
    class Meta:
        model = models.Epoca
        fields = '__all__'

class FichaSerializer(serializers.ModelSerializer):
    planta = PlantaSerializer()
    epocas = EpocaSerializer(many=True)
    class Meta:
        model = models.Ficha
        fields = '__all__'
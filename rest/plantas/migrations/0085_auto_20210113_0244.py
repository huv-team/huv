# Generated by Django 2.2.4 on 2021-01-13 02:44

from django.db import migrations, models
import plantas.models


class Migration(migrations.Migration):

    dependencies = [
        ('plantas', '0084_auto_20210113_0137'),
    ]

    operations = [
        migrations.AlterField(
            model_name='epoca',
            name='desde_dia',
            field=plantas.models.IntegerRangeField(default=0),
        ),
        migrations.AlterField(
            model_name='epoca',
            name='hasta_dia',
            field=plantas.models.IntegerRangeField(default=0),
        ),
        migrations.AlterField(
            model_name='epoca',
            name='hasta_mes',
            field=models.CharField(choices=[('1', 'Enero'), ('2', 'Febrero'), ('3', 'Marzo'), ('4', 'Abril'), ('5', 'Mayo'), ('6', 'Junio'), ('7', 'Julio'), ('8', 'Agosto'), ('9', 'Septiembre'), ('10', 'Octubre'), ('11', 'Noviembre'), ('12', 'Diciembre')], default='Enero', max_length=20),
        ),
        migrations.AlterField(
            model_name='epoca',
            name='tipo',
            field=models.CharField(choices=[('AL', 'Almácigo'), ('SI', 'Siembra'), ('TR', 'Trasplante'), ('CO', 'Cosecha')], default='AL', max_length=20),
        ),
    ]

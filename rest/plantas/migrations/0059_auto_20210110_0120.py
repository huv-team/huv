# Generated by Django 2.2.4 on 2021-01-10 01:20

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('plantas', '0058_auto_20210110_0057'),
    ]

    operations = [
        migrations.AlterField(
            model_name='epoca',
            name='desde_mes',
            field=models.CharField(blank=True, choices=[('1', 'Enero'), ('2', 'Febrero'), ('3', 'Marzo'), ('4', 'Abril'), ('5', 'Mayo'), ('6', 'Junio'), ('7', 'Julio'), ('8', 'Agosto'), ('9', 'Septiembre'), ('10', 'Octubre'), ('11', 'Noviembre'), ('12', 'Diciembre')], default='1', max_length=200, null=True),
        ),
        migrations.AlterField(
            model_name='epoca',
            name='hasta_mes',
            field=models.CharField(blank=True, choices=[('1', 'Enero'), ('2', 'Febrero'), ('3', 'Marzo'), ('4', 'Abril'), ('5', 'Mayo'), ('6', 'Junio'), ('7', 'Julio'), ('8', 'Agosto'), ('9', 'Septiembre'), ('10', 'Octubre'), ('11', 'Noviembre'), ('12', 'Diciembre')], default='12', max_length=200, null=True),
        ),
    ]

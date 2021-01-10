# Generated by Django 2.2.4 on 2021-01-10 19:38

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('plantas', '0062_auto_20210110_1937'),
    ]

    operations = [
        migrations.AlterField(
            model_name='autor',
            name='apellido',
            field=models.CharField(max_length=200, null=True),
        ),
        migrations.AlterField(
            model_name='autor',
            name='primer_nombre',
            field=models.CharField(max_length=200, null=True),
        ),
        migrations.AlterField(
            model_name='autor',
            name='segundo_nombre',
            field=models.CharField(blank=True, max_length=200, null=True),
        ),
        migrations.AlterField(
            model_name='fuente',
            name='tipo',
            field=models.CharField(blank=True, choices=[('LI', 'Libro'), ('RE', 'Revista'), ('PE', 'Periódico'), ('PW', 'Pagina web'), ('DI', 'Diccionario'), ('RS', 'Red social'), ('WP', 'Wikipedia'), ('PP', 'Power point')], default='Null', max_length=20, null=True),
        ),
    ]

# Generated by Django 2.2.4 on 2021-01-10 18:37

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('plantas', '0060_auto_20210110_1836'),
    ]

    operations = [
        migrations.AlterField(
            model_name='fuente',
            name='tipo',
            field=models.CharField(blank=True, choices=[('LI', 'Libro'), ('RE', 'Revista'), ('PE', 'Periódico'), ('PW', 'Pagina web'), ('DI', 'Diccionario'), ('RS', 'Red social'), ('WP', 'Wikipedia'), ('PP', 'Power point')], max_length=20, null=True),
        ),
    ]

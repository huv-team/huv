# Generated by Django 2.2.4 on 2021-01-02 19:58

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('plantas', '0046_auto_20210102_1914'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='fuente',
            name='otros_autores',
        ),
        migrations.RemoveField(
            model_name='fuente',
            name='primer_autor',
        ),
        migrations.RemoveField(
            model_name='interaccion',
            name='benefica',
        ),
        migrations.RemoveField(
            model_name='interaccion',
            name='perjudicial',
        ),
        migrations.AddField(
            model_name='interaccion',
            name='actor',
            field=models.ManyToManyField(blank=True, to='plantas.Planta'),
        ),
        migrations.AddField(
            model_name='interaccion',
            name='descripcion',
            field=models.TextField(blank=True, null=True),
        ),
        migrations.AddField(
            model_name='interaccion',
            name='tipo',
            field=models.CharField(choices=[('B', 'Benéfica'), ('P', 'Perjudicial')], default='B', max_length=200),
        ),
        migrations.AlterField(
            model_name='tipo',
            name='nombre',
            field=models.CharField(blank=True, choices=[('FR', 'Fruto'), ('FL', 'Flor'), ('HO', 'Hoja'), ('RA', 'Raiz')], max_length=200, null=True),
        ),
    ]

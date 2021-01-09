# Generated by Django 2.2.4 on 2021-01-09 19:49

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ('plantas', '0053_auto_20210109_1929'),
    ]

    operations = [
        migrations.RenameField(
            model_name='epoca',
            old_name='desde',
            new_name='desde_mes',
        ),
        migrations.RenameField(
            model_name='epoca',
            old_name='hasta',
            new_name='hasta_mes',
        ),
        migrations.RemoveField(
            model_name='ficha',
            name='epoca_cosecha',
        ),
        migrations.RemoveField(
            model_name='ficha',
            name='epoca_semillero',
        ),
        migrations.RemoveField(
            model_name='ficha',
            name='epoca_siembra',
        ),
        migrations.RemoveField(
            model_name='ficha',
            name='epoca_trasplante',
        ),
        migrations.AddField(
            model_name='epoca',
            name='desde_dia',
            field=models.IntegerField(blank=True, null=True),
        ),
        migrations.AddField(
            model_name='epoca',
            name='hasta_dia',
            field=models.IntegerField(blank=True, null=True),
        ),
        migrations.AddField(
            model_name='ficha',
            name='epocas',
            field=models.ForeignKey(blank=True, null=True, on_delete=django.db.models.deletion.SET_NULL, related_name='asignada_en', to='plantas.Epoca'),
        ),
    ]

# Generated by Django 2.2.4 on 2020-12-28 21:32

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ('plantas', '0025_auto_20201227_1629'),
    ]

    operations = [
        migrations.AlterField(
            model_name='planta',
            name='familia',
            field=models.ForeignKey(blank=True, null=True, on_delete=django.db.models.deletion.SET_NULL, related_name='plantas', to='plantas.Familia'),
        ),
    ]

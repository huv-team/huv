# Generated by Django 2.2.4 on 2021-01-11 17:37

from django.db import migrations
import plantas.models


class Migration(migrations.Migration):

    dependencies = [
        ('plantas', '0070_auto_20210111_1730'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='ficha',
            name='tiempo_cultivo_semanas',
        ),
        migrations.AddField(
            model_name='ficha',
            name='tiempo_cultivo_min_dias',
            field=plantas.models.IntegerRangeField(blank=True, null=True),
        ),
    ]

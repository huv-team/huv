# Generated by Django 2.2.4 on 2021-01-11 17:38

from django.db import migrations
import plantas.models


class Migration(migrations.Migration):

    dependencies = [
        ('plantas', '0071_auto_20210111_1737'),
    ]

    operations = [
        migrations.AddField(
            model_name='ficha',
            name='tiempo_cultivo_max_dias',
            field=plantas.models.IntegerRangeField(blank=True, null=True),
        ),
    ]

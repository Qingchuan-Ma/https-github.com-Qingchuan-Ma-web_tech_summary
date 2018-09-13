# -*- coding: utf-8 -*-
# Generated by Django 1.11.7 on 2017-12-03 12:15
from __future__ import unicode_literals

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('Questionare', '0001_initial'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='answer',
            name='question',
        ),
        migrations.RemoveField(
            model_name='question',
            name='person',
        ),
        migrations.AddField(
            model_name='person',
            name='age',
            field=models.IntegerField(default=12),
            preserve_default=False,
        ),
        migrations.AddField(
            model_name='person',
            name='e_mail',
            field=models.CharField(default='xxxxxxx@pku.edu.cn', max_length=200),
            preserve_default=False,
        ),
        migrations.AddField(
            model_name='person',
            name='gender',
            field=models.CharField(default='male', max_length=50),
            preserve_default=False,
        ),
        migrations.DeleteModel(
            name='Answer',
        ),
        migrations.DeleteModel(
            name='Question',
        ),
    ]

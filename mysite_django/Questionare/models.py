# -*- coding: utf-8 -*-
from __future__ import unicode_literals
from django.db import models
import datetime



class Person(models.Model):
    name =models.CharField(max_length=200)
    age = models.IntegerField()
    gender = models.CharField(max_length=50)
    e_mail = models.CharField(max_length=200)
    def __str__(self):
        return self.name

'''
Name.
Age.
Gender.
E_mail address.
'''
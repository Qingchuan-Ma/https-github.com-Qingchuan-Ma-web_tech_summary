# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.conf.urls import url

from .views import DefaultFormView


app_name = 'bootstrapdemo'
urlpatterns = [
    url(r'^$', DefaultFormView.as_view(),name='index'),
]

# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.views.generic import FormView
from django.views.generic.base import TemplateView

from .forms import ContactForm



class DefaultFormView(FormView):
    template_name = 'bootstrapdemo/form.html'
    form_class = ContactForm


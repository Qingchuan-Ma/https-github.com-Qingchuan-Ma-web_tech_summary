# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.http import HttpResponse
from django.shortcuts import get_object_or_404,render
from django.http import HttpResponseRedirect
from django.urls import reverse
from django.views import generic
from .models import Person

# Create your views here.
def index(request):
    return render(request, 'Questionare/index.html')


def submit(request):
    person = Person()
    person.name = request.POST['name']
    person.age = request.POST['age']
    person.gender = request.POST['gender']
    person.e_mail = request.POST['e_mail']
    person.save()

    person_list = Person.objects.all()
    context = {'person_list': person_list}

    return render(request,'Questionare/results.html',context)













'''
def index(request):
    latest_question_list = Question.objects.order_by('-pub_date')[:5]
    context = {'latest_question_list': latest_question_list}
    return render(request, 'polls/index.html', context)

def vote(request, question_id):
    question = get_object_or_404(Question, pk=question_id)
    try:
        selected_choice = question.choice_set.get(pk=request.POST['choice'])
    except (KeyError, Choice.DoesNotExist):
        # Redisplay the question voting form.
        return render(request, 'polls/detail.html', {
            'question': question,
            'error_message': "You didn't select a choice.",
        })
    else:
        selected_choice.votes += 1
        selected_choice.save()
        # Always return an HttpResponseRedirect after successfully dealing
        # with POST data. This prevents data from being posted twice if a
        # user hits the Back button.
        return HttpResponseRedirect(reverse('polls:results', args=(question.id,)))
'''





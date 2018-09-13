
from rest_framework import routers
from . import views
from django.conf.urls import url , include


router = routers.DefaultRouter()
router.register(r'users', views.UserViewSet)
router.register(r'groups', views.GroupViewSet)


app_name = 'restdemo'
urlpatterns  = [
url(r'^', include(router.urls)),
url(r'^api-auth/', include('rest_framework.urls', namespace='rest_framework')),]
from django.urls import path

from plantas import views

app_name = 'plantas'
urlpatterns = [

    path('s', views.PlantaViewSet.as_view({'get': 'list', 'post': 'create'}),
         name='plantas-list'),
    path('<int:pk>', views.PlantaViewSet.as_view({'get': 'retrieve',
         'put': 'update', 'delete': 'destroy'}), name='plantas-list'),

]
from django.urls import path

from plantas import views

app_name = 'plantas'
urlpatterns = [
     path('s', views.PlantaViewSet.as_view({'get': 'list'}), name='plantas-list'),
     path('/', views.PlantaViewSet.as_view({'post': 'create'}), name='planta-new'),
     path('/<int:pk>', views.PlantaViewSet.as_view({'get': 'retrieve', 'put': 'update', 'delete': 'destroy'}), name='plantas-detail'),

     path('/fichas', views.FichaViewSet.as_view({'get': 'list'}), name='fichass-list'),
     path('/ficha/', views.FichaViewSet.as_view({'post': 'create'}), name='ficha-new'),
     path('/ficha/<int:pk>', views.FichaViewSet.as_view({'get': 'retrieve', 'put': 'update', 'delete': 'destroy'}), name='ficha-detail'),
]

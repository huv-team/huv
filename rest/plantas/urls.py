from django.urls import path

from plantas import views

app_name = 'plantas'
urlpatterns = [
     path('s', views.PlantaViewSet.as_view({'get': 'list'}), name='plantas-list'),
     path('/', views.PlantaViewSet.as_view({'post': 'create'}), name='planta-new'),
     path('/<int:pk>', views.PlantaViewSet.as_view({'get': 'retrieve', 'put': 'update', 'delete': 'destroy'}), name='plantas-detail'),

     path('/tipos', views.TipoViewSet.as_view({'get': 'list'}), name='tipos-list'),
     
     path('/meses', views.ListMeses.as_view(), name='meses-list'),

     path('/macetas', views.ListMacetas.as_view(), name='macetas-list'),
     
     path('/fichas', views.FichaViewSet.as_view({'get': 'list'}), name='fichas-list'),
     path('/ficha/', views.FichaViewSet.as_view({'post': 'create'}), name='ficha-new'),
     path('/ficha/<int:pk>', views.FichaViewSet.as_view({'get': 'retrieve', 'put': 'update', 'delete': 'destroy'}), name='ficha-detail'),

     path('/fuentes', views.FuenteViewSet.as_view({'get': 'list'}), name='fuentes-list'),

]

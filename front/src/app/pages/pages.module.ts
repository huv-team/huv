import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';
import { ReactiveFormsModule, FormsModule } from "@angular/forms";

import { ComponentsModule } from "src/app/components/components.module";

import { BienvenidaComponent } from './bienvenida/bienvenida.component';
import { PlantasComponent } from './plantas/plantas.component';
import { FichaComponent } from './ficha/ficha.component';
import { NotFoundComponent } from './not-found/not-found.component';
import { FuentesComponent } from './fuentes/fuentes.component';

const routes: Routes = [
  {path: '', component: BienvenidaComponent},
  {path: 'plantas', component: PlantasComponent},
  {path: 'fuentes', component: FuentesComponent},
  {path: 'ficha', component: FichaComponent},
  {path: '404', component: NotFoundComponent},
]

@NgModule({
  declarations: [BienvenidaComponent, PlantasComponent, FichaComponent, NotFoundComponent, FuentesComponent],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    ComponentsModule,
    ReactiveFormsModule,
    FormsModule,
  ]
})
export class PagesModule { }

import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { ComponentsModule } from "src/app/components/components.module";

import { BienvenidaComponent } from './bienvenida/bienvenida.component';
import { PlantasComponent } from './plantas/plantas.component';

const routes: Routes = [
  {path: '', component: BienvenidaComponent},
  {path: 'plantas', component: PlantasComponent},
]

@NgModule({
  declarations: [BienvenidaComponent, PlantasComponent],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    ComponentsModule,
  ]
})
export class PagesModule { }

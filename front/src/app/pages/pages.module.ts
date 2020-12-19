import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { BienvenidaComponent } from './bienvenida/bienvenida.component';

const routes: Routes = [
  {path: '', component: BienvenidaComponent},
]

@NgModule({
  declarations: [BienvenidaComponent],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
  ]
})
export class PagesModule { }

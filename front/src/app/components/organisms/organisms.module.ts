import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NavBarComponent } from './nav-bar/nav-bar.component';

import { AtomsModule } from "src/app/components/atoms/atoms.module";
import { MoleculesModule } from "src/app/components/molecules/molecules.module";
import { FooterComponent } from './footer/footer.component';

import { MacetasGroupComponent } from './macetas-group/macetas-group.component';
import { PlanificadorComponent } from './planificador/planificador.component';

@NgModule({
  declarations: [
    NavBarComponent,
    FooterComponent,
    MacetasGroupComponent,
    PlanificadorComponent,
  ],
    imports: [
    CommonModule,
    AtomsModule,MoleculesModule,
  ],
  exports: [
    NavBarComponent,
    FooterComponent,
    MacetasGroupComponent,
    PlanificadorComponent,
  ]
})
export class OrganismsModule { }

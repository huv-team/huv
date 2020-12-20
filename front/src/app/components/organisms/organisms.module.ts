import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NavBarComponent } from './nav-bar/nav-bar.component';

import { AtomsModule } from "src/app/components/atoms/atoms.module";
import { MoleculesModule } from "src/app/components/molecules/molecules.module";
import { FooterComponent } from './footer/footer.component';

@NgModule({
  declarations: [NavBarComponent, FooterComponent],
  imports: [
    CommonModule,
    AtomsModule,MoleculesModule,
  ],
  exports: [NavBarComponent, FooterComponent]
})
export class OrganismsModule { }

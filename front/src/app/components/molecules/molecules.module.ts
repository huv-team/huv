import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AtomsModule } from "src/app/components/atoms/atoms.module";
import { EpocasCalendarComponent } from './epocas-calendar/epocas-calendar.component';
import { PlantaCardComponent } from './planta-card/planta-card.component';
import { DatoCardComponent } from './dato-card/dato-card.component';

@NgModule({
  declarations: [EpocasCalendarComponent, PlantaCardComponent, DatoCardComponent],
  imports: [
    CommonModule,
    AtomsModule,
  ],
  exports: [EpocasCalendarComponent, PlantaCardComponent, DatoCardComponent]
})
export class MoleculesModule { }

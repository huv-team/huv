import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AtomsModule } from "src/app/components/atoms/atoms.module";
import { EpocasCalendarComponent } from './epocas-calendar/epocas-calendar.component';

@NgModule({
  declarations: [EpocasCalendarComponent],
  imports: [
    CommonModule,
    AtomsModule,
  ],
  exports: [EpocasCalendarComponent]
})
export class MoleculesModule { }

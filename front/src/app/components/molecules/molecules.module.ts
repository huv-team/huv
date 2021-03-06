import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AtomsModule } from "src/app/components/atoms/atoms.module";
import { EpocasCalendarComponent } from './epocas-calendar/epocas-calendar.component';
import { PlantaCardComponent } from './planta-card/planta-card.component';
import { DatoCardComponent } from './dato-card/dato-card.component';
import { TipCardComponent } from './tip-card/tip-card.component';
import { FuenteCardComponent } from './fuente-card/fuente-card.component';
import { TipoSelectComponent } from './tipo-select/tipo-select.component';
import { MesSelectComponent } from './mes-select/mes-select.component';
import { MacetaSelectComponent } from './maceta-select/maceta-select.component';

@NgModule({
  declarations: [
    EpocasCalendarComponent,
    PlantaCardComponent,
    DatoCardComponent,
    TipCardComponent,
    FuenteCardComponent,
    TipoSelectComponent,
    MesSelectComponent,
    MacetaSelectComponent,
  ],
  imports: [
    CommonModule,
    AtomsModule,
  ],
  exports: [
    EpocasCalendarComponent,
    PlantaCardComponent,
    DatoCardComponent,
    TipCardComponent,
    FuenteCardComponent,
    TipoSelectComponent,
    MesSelectComponent,
    MacetaSelectComponent,
  ]
})
export class MoleculesModule { }

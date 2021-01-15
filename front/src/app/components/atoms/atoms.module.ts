import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LogoComponent } from './logo/logo.component';
import { UserTileComponent } from './user-tile/user-tile.component';
import { CalendarTilesComponent } from './calendar-tiles/calendar-tiles.component';
import { TrasplanteComponent } from './icons/trasplante/trasplante.component';
import { AlmacigoComponent } from './icons/almacigo/almacigo.component';
import { CosechaComponent } from './icons/cosecha/cosecha.component';
import { SiembraComponent } from './icons/siembra/siembra.component';



@NgModule({
  declarations: [LogoComponent, UserTileComponent, CalendarTilesComponent, TrasplanteComponent, AlmacigoComponent, CosechaComponent, SiembraComponent],
  imports: [
    CommonModule
  ],
  exports: [LogoComponent, UserTileComponent, CalendarTilesComponent, TrasplanteComponent, AlmacigoComponent, CosechaComponent, SiembraComponent]
})
export class AtomsModule { }

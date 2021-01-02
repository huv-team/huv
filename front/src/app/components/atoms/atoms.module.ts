import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LogoComponent } from './logo/logo.component';
import { UserTileComponent } from './user-tile/user-tile.component';
import { CalendarTilesComponent } from './calendar-tiles/calendar-tiles.component';



@NgModule({
  declarations: [LogoComponent, UserTileComponent, CalendarTilesComponent],
  imports: [
    CommonModule
  ],
  exports: [LogoComponent, UserTileComponent, CalendarTilesComponent]
})
export class AtomsModule { }

import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LogoComponent } from './logo/logo.component';
import { UserTileComponent } from './user-tile/user-tile.component';



@NgModule({
  declarations: [LogoComponent, UserTileComponent],
  imports: [
    CommonModule
  ],
  exports: [LogoComponent, UserTileComponent]
})
export class AtomsModule { }

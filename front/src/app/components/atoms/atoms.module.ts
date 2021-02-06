import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LogoComponent } from './logo/logo.component';
import { UserTileComponent } from './user-tile/user-tile.component';
import { CalendarTilesComponent } from './calendar-tiles/calendar-tiles.component';
import { TrasplanteComponent } from './icons/trasplante/trasplante.component';
import { AlmacigoComponent } from './icons/almacigo/almacigo.component';
import { CosechaComponent } from './icons/cosecha/cosecha.component';
import { SiembraComponent } from './icons/siembra/siembra.component';
import { FlorComponent } from './icons/flor/flor.component';
import { RaizComponent } from './icons/raiz/raiz.component';
import { HojaComponent } from './icons/hoja/hoja.component';
import { FrutoComponent } from './icons/fruto/fruto.component';
import { TipoTilesComponent } from './tipo-tiles/tipo-tiles.component';
import { CalendarioComponent } from './icons/calendario/calendario.component';
import { MacetaComponent } from './icons/maceta/maceta.component';
import { SolComponent } from './icons/sol/sol.component';
import { RiegoComponent } from './icons/riego/riego.component';
import { DatoTilesComponent } from './dato-tiles/dato-tiles.component';
import { DistanciaComponent } from './icons/distancia/distancia.component';
import { SombraComponent } from './icons/sombra/sombra.component';
import { TemperaturaComponent } from './icons/temperatura/temperatura.component';
import { FecundacionComponent } from './icons/fecundacion/fecundacion.component';
import { TutorComponent } from './icons/tutor/tutor.component';
import { TamanoComponent } from './icons/tamano/tamano.component';
import { TipComponent } from './icons/tip/tip.component';

@NgModule({
  declarations: [LogoComponent, UserTileComponent, CalendarTilesComponent, TrasplanteComponent, AlmacigoComponent, CosechaComponent, SiembraComponent, FlorComponent, RaizComponent, HojaComponent, FrutoComponent, TipoTilesComponent, CalendarioComponent, MacetaComponent, SolComponent, RiegoComponent, DatoTilesComponent, DistanciaComponent, SombraComponent, TemperaturaComponent, FecundacionComponent, TutorComponent, TamanoComponent, TipComponent],
  imports: [
    CommonModule
  ],
  exports: [LogoComponent, UserTileComponent, CalendarTilesComponent, TrasplanteComponent, AlmacigoComponent, CosechaComponent, SiembraComponent, FlorComponent, RaizComponent, HojaComponent, FrutoComponent, TipoTilesComponent, CalendarioComponent, MacetaComponent, SolComponent, RiegoComponent, DatoTilesComponent]
})
export class AtomsModule { }

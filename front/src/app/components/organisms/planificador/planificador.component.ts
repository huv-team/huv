import { Component, OnInit, ViewChild } from '@angular/core';

import { MacetasGroupComponent } from "src/app/components/organisms/macetas-group/macetas-group.component";
import { TipoSelectComponent } from "src/app/components/molecules/tipo-select/tipo-select.component";
import { MesSelectComponent } from "src/app/components/molecules/mes-select/mes-select.component";
import { PlantasService } from 'src/app/services/plantas.service';

@Component({
  selector: 'app-planificador',
  templateUrl: './planificador.component.html',
  styleUrls: ['./planificador.component.scss']
})
export class PlanificadorComponent implements OnInit {
  
  @ViewChild(MacetasGroupComponent) macetas: MacetasGroupComponent;
  @ViewChild(TipoSelectComponent) tipos: TipoSelectComponent;
  @ViewChild(MesSelectComponent) meses: MesSelectComponent;
  query:any = {};
  
  volumenesMaceta:number[] = [];
  profundidadesMaceta:number[] = [];
  loading:boolean;
  
  constructor(
    private plantasSrv:PlantasService
  ) { }

  ngOnInit(): void {
    this.loading = true;
    this.plantasSrv.get_maseta_data().subscribe(
      res => {
        this.volumenesMaceta = res.pots_sizes['volumenes'];
        this.profundidadesMaceta = res.pots_sizes['profundidades'];
      },
      err => {
        console.log(err);
      },
      () => {
        this.loading = false;
      }
    )
  }

  set actividad(data:string) {
    this.query['actividad'] = data;
  }

  get data():any {
    let query = {...this.query};
    switch(this.query['actividad']){
      case 'AL':
        query = {
          ...query,
          tipos: this.tipos.selection,
          meses: Array.from(this.meses.selection),
        }
        break;
      case 'SI':
        query = {
          ...query,
          tipos: this.tipos.selection,
          meses: Array.from(this.meses.selection),
          macetas: this.macetas.values
        }
        break;
      case 'TR':
        query = {
          ...query,
          meses: Array.from(this.meses.selection),
        }
        break;
    }
    return query;
  }

}

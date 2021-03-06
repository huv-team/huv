import { Component, OnInit } from '@angular/core';

import { PlantasService } from 'src/app/services/plantas.service';

@Component({
  selector: 'app-planificador',
  templateUrl: './planificador.component.html',
  styleUrls: ['./planificador.component.scss']
})
export class PlanificadorComponent implements OnInit {

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
        this.volumenesMaceta = res['volumenes'];
        this.profundidadesMaceta = res['profundidades'];
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
  
  set tipos(data:any) {
    this.query['tipos'] = data;
  }

  set meses(data:any) {
    this.query['meses'] = data;
  }

  set macetas(data:any){
    this.query['macetas'] = data;
  }

}

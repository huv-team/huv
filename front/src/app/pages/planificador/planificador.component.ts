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
  
  set tipos(data:any) {
    this.query['tipos'] = data.map( el => el.nombre );
  }

  set meses(data:any) {
    this.query['meses'] = data.map( el => el.id );
  }

  set macetas(data:any){
    this.query['macetas'] = data;
  }

  search(){
    console.log('searching...',this.query)
    this.plantasSrv.search_plantas(this.query).subscribe(
      res => console.log(res)

    )
  }

}

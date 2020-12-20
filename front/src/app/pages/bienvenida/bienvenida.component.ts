import { Component, OnInit } from '@angular/core';

import { PlantasService } from "src/app/services/plantas.service";

@Component({
  selector: 'app-bienvenida',
  templateUrl: './bienvenida.component.html',
  styleUrls: ['./bienvenida.component.scss']
})
export class BienvenidaComponent implements OnInit {

  plantasList:any;
  
  constructor(
    private plantasSrv:PlantasService,
  ) { }

  ngOnInit(): void {
    this.plantasSrv.get_plantas_list().subscribe(
      res => {
        this.plantasList = res;
      },
      err => {
        console.log(err);
      }
    );
  }

}

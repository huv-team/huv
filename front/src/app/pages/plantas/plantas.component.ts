import { Component, OnInit } from '@angular/core';

import { PlantasService } from "src/app/services/plantas.service";

@Component({
  selector: 'app-plantas',
  templateUrl: './plantas.component.html',
  styleUrls: ['./plantas.component.scss']
})
export class PlantasComponent implements OnInit {

  plantasList:any;
  
  constructor(
    private plantasSrv:PlantasService,
  ) { }

  ngOnInit(): void {
    this.plantasSrv.get_plantas_list().subscribe(
      res => {
        console.log(res.length)
        this.plantasList = res;
      },
      err => {
        console.log(err);
      }
    );
  }

}

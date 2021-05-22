import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from "@angular/forms";

import { PlantasService } from "src/app/services/plantas.service";
import { Router } from '@angular/router';

@Component({
  selector: 'app-plantas',
  templateUrl: './plantas.component.html',
  styleUrls: ['./plantas.component.scss']
})
export class PlantasComponent implements OnInit {

  plantasList:any;
  plantasQueryForm:FormGroup;
  
  constructor(
    private plantasSrv:PlantasService,
    private router:Router,
  ) { }

  ngOnInit(): void {
    this.plantasSrv.get_plantas_list().subscribe(
      res => {
        console.log(res)
        this.plantasList = res['plants'];
      },
      err => {
        console.log(err);
      }
    );

    this.plantasQueryForm = new FormGroup({
      nombre: new FormControl(''),
    })

  }

  buscar() {
    const query = 'nombre=' + this.plantasQueryForm.value.nombre
    this.plantasSrv.get_plantas_list(query).subscribe(
      res => {
        this.plantasList = res;
      },
      err => {
        console.log(err);
      }
    );
  }

  navigate2ficha(pk:number) {
    this.router.navigate(['ficha'], { queryParams: { pk:pk } });
  }

}

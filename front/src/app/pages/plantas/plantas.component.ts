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

  searching:boolean = false;
  
  constructor(
    private plantasSrv:PlantasService,
    private router:Router,
  ) { }

  ngOnInit(): void {
    this.plantasSrv.search_plantas().subscribe(
      res => {
        this.plantasList = res['plants'];
      },
      err => {
        console.log(err);
      }
    );

    this.plantasQueryForm = new FormGroup({
      name: new FormControl(''),
    })

  }

  buscar() {
    this.searching = true
    this.plantasSrv.search_plantas(this.query).subscribe(
      res => {
        this.plantasList = res['plants'];
        this.searching =false;
      },
      err => {
        console.log(err);
      }
    );
  }

  get query(){
    return {
      ...Object.entries(this.plantasQueryForm.value).filter( ([_, v]) => v != null ).reduce( (a,k) => ({...a, [k[0]]:k[1]}), {}),
    };
  }

}

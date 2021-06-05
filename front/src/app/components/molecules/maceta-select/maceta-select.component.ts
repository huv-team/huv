import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { PlantasService } from 'src/app/services/plantas.service';

@Component({
  selector: 'app-maceta-select',
  templateUrl: './maceta-select.component.html',
  styleUrls: ['./maceta-select.component.scss']
})
export class MacetaSelectComponent implements OnInit {

  @Input() volumenes:number[];
  @Input() profundidades:number[];
  volumen:number;
  profundidad:number;
  @Output() valueChange = new EventEmitter<any>(true);
  
  constructor(
    private plantasSrv:PlantasService,
  ) { }

  ngOnInit(): void {
    this.volumen = this.volumenes[0];
    this.profundidad = this.profundidades[0];
    console.log(this.volumenes, this.profundidades);
  }

  volumenChange(value:number){
    console.log(value);
    this.volumen = this.volumenes[value];
    this.valueChange.emit({volumen:this.volumen,profundidad:this.profundidad});
  }

  profundidadChange(value:number){
    this.profundidad = this.profundidades[value];
    this.valueChange.emit({volumen:this.volumen,profundidad:this.profundidad});
  }

}

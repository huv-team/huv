import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-maceta-select',
  templateUrl: './maceta-select.component.html',
  styleUrls: ['./maceta-select.component.scss']
})
export class MacetaSelectComponent implements OnInit {

  @Input() volumenes:number[];
  @Input() profundidades:number[];
  volumen_idx:number;
  profundidad_idx:number;
  
  constructor( ) { }

  get volumen() {
    return this.volumenes[this.volumen_idx];
  }

  get profundidad() {
    return this.profundidades[this.profundidad_idx];
  }

  ngOnInit(): void {
    this.volumen_idx = 0;
    this.profundidad_idx = 0;
  }

  get values() {
    return {volumen:this.volumen,profundidad:this.profundidad};
  }

  cangeVolumen(value:number){
    this.volumen_idx += value;
    this.volumen_idx = (this.volumen_idx < 0) ? 0 : this.volumen_idx;
    this.volumen_idx = (this.volumen_idx > this.volumenes.length-1) ? this.volumenes.length-1 : this.volumen_idx;
  }

  changeProfundidad(value:number){
    this.profundidad_idx += value;
    this.profundidad_idx = (this.profundidad_idx < 0) ? 0 : this.profundidad_idx;
    this.profundidad_idx = (this.profundidad_idx > this.volumenes.length-1) ? this.volumenes.length-1 : this.profundidad_idx;
  }

}

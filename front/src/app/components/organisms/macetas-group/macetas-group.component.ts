import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-macetas-group',
  templateUrl: './macetas-group.component.html',
  styleUrls: ['./macetas-group.component.scss']
})
export class MacetasGroupComponent implements OnInit {

  @Input() label:string = 'Macetas disponibles:';

  @Input() volumenes:number[];
  @Input() profundidades:number[];

  @Output() groupChange = new EventEmitter<any>(true);  
  macetas:any[];
  
  constructor() { }

  ngOnInit(): void {
    this.macetas = [];
  }

  emit() {
    this.groupChange.emit(this.macetas.filter( el => el.volumen && el.profundidad ));
  }

  agregar() {
    this.macetas.push({volumen:null,profundidad:null});
  }

  actualizar(idx:number,$event:any){
    this.macetas[idx] = $event;
    this.emit();
  }

  quitar(idx:number) {
    this.macetas.splice(idx,1);
    this.emit();
  }

}

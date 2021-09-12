import { Component, OnInit, Input, ViewChildren, QueryList } from '@angular/core';
import { MacetaSelectComponent } from "src/app/components/molecules/maceta-select/maceta-select.component";

@Component({
  selector: 'app-macetas-group',
  templateUrl: './macetas-group.component.html',
  styleUrls: ['./macetas-group.component.scss']
})
export class MacetasGroupComponent implements OnInit {

  @Input() label:string = 'Macetas disponibles:';

  @Input() volumenes:number[];
  @Input() profundidades:number[];

  @ViewChildren(MacetaSelectComponent) children:QueryList<any>;
  macetas:any[];
  
  constructor() { }

  ngOnInit(): void {
    this.macetas = [{}];
  }

  agregar() {
    this.macetas.push({});
  }

  quitar(idx:number) {
    this.macetas.splice(idx,1);
  }

  get values(){
    return this.children.map( child => child.values );
  }

}

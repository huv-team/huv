import { Component, OnInit, Input } from '@angular/core';

export interface Epoca {
  id: number,
  tipo: string,
  desde_dia: number|null,
  desde_mes: number,
  hasta_dia: number|null,
  hasta_mes: number
}

export interface Data {
  title:string;
  selected:Set<number>;
  color:string;
}


@Component({
  selector: 'app-epocas-calendar',
  templateUrl: './epocas-calendar.component.html',
  styleUrls: ['./epocas-calendar.component.scss']
})
export class EpocasCalendarComponent implements OnInit {

  @Input() meses:string[] = ['ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC'];
  @Input() epocas:Epoca[] = [];

  data:Data[] = [];
  tipos:Set<string> = new Set<string>(['SI','AL','TR','CO']);
  
  constructor() { }

  ngOnInit(): void {
    this.tipos.forEach( tipo => {
      let meses:Set<number> = new Set<number>();
      this.epocas.filter( epoca => epoca.tipo === tipo ).forEach( epoca => {
        for (let i:number = epoca.desde_mes; i <= epoca.hasta_mes; i++) { meses.add(i) }
      })
      this.data.push({ title: tipo, selected:meses, color:'primary' })
    });
  }

  isSelected(i:number,j:number){
    return this.data[i].selected.has(j+1);
  }

  getBgColor(i:number){
    return this.data[i].color
  }

}

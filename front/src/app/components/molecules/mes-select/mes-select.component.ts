import { Component, OnInit, Output, Input, EventEmitter } from '@angular/core';
import { PlantasService } from 'src/app/services/plantas.service';

@Component({
  selector: 'app-mes-select',
  templateUrl: './mes-select.component.html',
  styleUrls: ['./mes-select.component.scss']
})
export class MesSelectComponent implements OnInit {

  @Input() multi:boolean = false;
  @Input() label:string = 'Selecciona un mes:';

  selected:Set<number> = new Set<number>([1]);

  meses:string[] = [
    'ENERO','FEBRERO','MARZO','ABRIL',
    'MAYO','JUNIO','JULIO','AGOSTO',
    'SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'
  ];
  loading:boolean;

  @Output() selectionChange = new EventEmitter<any>(true);
  
  constructor(
    private plantasSrv:PlantasService,
  ) { }

  ngOnInit(): void { }

  get selection(){
    return this.multi ? this.selected : this.selected[0]
  }

  isSelected(idx:number):boolean {
    return this.selected.has(idx);
  }

  changeSelected(idx:number) {
    if (this.multi){
      if (this.isSelected(idx)){
        this.selected.delete(idx);
      }else{
        this.selected.add(idx);
      }
    }else{
      this.selected.clear();
      this.selected.add(idx);
    }
    this.selectionChange.emit(Array.from(this.selected, el => this.meses[el]));
  }

}

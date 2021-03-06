import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { PlantasService } from 'src/app/services/plantas.service';

@Component({
  selector: 'app-tipo-select',
  templateUrl: './tipo-select.component.html',
  styleUrls: ['./tipo-select.component.scss']
})
export class TipoSelectComponent implements OnInit {

  @Input() multi:boolean = false;
  @Input() label:string = 'Selecciona un tipo:';

  selected:Set<number> = new Set<number>([1]);

  types:any[] = [];
  loading:boolean;

  @Output() selectionChange = new EventEmitter<any>(true);
  
  constructor(
    private plantasSrv:PlantasService,
  ) { }
  
  ngOnInit(): void {
    this.loading = true;
    this.plantasSrv.get_tipos_list().subscribe(
      res => {
        this.types = res;
      },
      err => {
        console.log(err);
      },
      () => {
        this.loading = false;
      }
    )
  }

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
    this.selectionChange.emit(Array.from(this.selected, el => this.types[el]));
  }

}

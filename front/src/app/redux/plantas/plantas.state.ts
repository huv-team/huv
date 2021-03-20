import { Injectable } from '@angular/core';
import { tap } from 'rxjs/operators';
import { State, Action, StateContext } from '@ngxs/store';

import { PlantasStateModel } from "./plantas.model";
import { GetPlantas } from "./plantas.actions";

import { PlantasService } from "src/app/services/plantas.service";

@State<PlantasStateModel>({
    name: 'plantas',
    defaults: {
        list: []
    }
})
@Injectable()
export class PlantasState {

    constructor(
        private plantasSrv:PlantasService,
    ) { }
    
    @Action(GetPlantas)
    getPlantasList(ctx: StateContext<PlantasStateModel>) {
        return this.plantasSrv.get_plantas_list().pipe(
            tap( res => {
                const state = ctx.getState();
                ctx.setState({
                    ...state,
                    list: res
                });
            })
        );
    }
}
import { Injectable } from '@angular/core';
import { State, Action, StateContext } from '@ngxs/store';

import { SiteStateModel, SitePage } from "./site.model";

@State<SiteStateModel>({
    name: 'plantas',
    defaults: {
        active: SitePage.bienvenida
    }
})
@Injectable()
export class SiteState {}
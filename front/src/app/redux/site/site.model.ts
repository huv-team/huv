export enum SitePage {
    bienvenida = '',
    plantas = 'plantas',
    ficha = 'ficha',
    planificador = 'planificador',
    fuentes = 'fuentes',
    not_found = '404'
}

export interface SiteStateModel {
    active: SitePage;
}
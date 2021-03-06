import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MesSelectComponent } from './mes-select.component';

describe('MesSelectComponent', () => {
  let component: MesSelectComponent;
  let fixture: ComponentFixture<MesSelectComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MesSelectComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MesSelectComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

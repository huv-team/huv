import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SombraComponent } from './sombra.component';

describe('SombraComponent', () => {
  let component: SombraComponent;
  let fixture: ComponentFixture<SombraComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SombraComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SombraComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
